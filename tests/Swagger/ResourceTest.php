<?php

/**
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * Copyright [2012] [Robert Allen]
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category Swagger
 * @package Swagger
 * @subpackage UnitTests
 */
namespace SwaggerTests;
use Swagger\Swagger;

/*
 *
 *
 * @category   Swagger
 * @package    Swagger
 * @subpackage UnitTests
 */
class ResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Swagger_Resource
     */
    protected $resource;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_resourceFixture = array(
        'apis' => array(
            array(
                'path' => '/organic',
                'description' => 'Gets collection of organics'
             ),array(
                'path' => '/leadresponder',
                'description' => 'Gets collection of leadresponders'
                )
            ),
            'basePath' => 'http://org.local/v1',
            'swaggerVersion' => '0.1a',
            'apiVersion' => 1
        );
        $api =<<<JSON
{
  "apis":[
    {
      "operations":[
        {
          "tags":[
            "MLR"
          ],
          "errorResponses":[
            {
              "code":"403",
              "reason":"User Not Authorized"
            }
          ],
          "parameters":[

          ],
          "httpMethod":"GET",
          "responseClass":"List[leadresonder_route]",
          "summary":"Fetches the leadresponder corresponding the the provided ID"
        },
        {
          "tags":[
            "MLR"
          ],
          "errorResponses":[
            {
              "code":"403",
              "reason":"User Not Authorized"
            }
          ],
          "parameters":[
            {
              "description":"leadresponder_route being created",
              "required":"true",
              "allowMultiple":"false",
              "dataType":"leadresponder_route",
              "name":"leadresponder_route",
              "paramType":"body"
            }
          ],
          "httpMethod":"POST",
          "responseClass":"leadresonder_route",
          "summary":"Creates a new leadresponder"
        }
      ],
      "path":"\/leadresponder"
    },
    {
      "operations":[
        {
          "tags":[
            "MLR"
          ],
          "errorResponses":[
            {
              "code":"400",
              "reason":"Invalid ID Provided"
            },
            {
              "code":"403",
              "reason":"User Not Authorized"
            },
            {
              "code":"404",
              "reason":"Lead Responder Not Found"
            }
          ],
          "parameters":[
            {
              "description":"ID of the leadresponder being requested",
              "required":"true",
              "allowMultiple":"false",
              "dataType":"integer",
              "name":"leadresponder_id",
              "paramType":"path"
            },
            {
              "description":"leadresponder_route being updated",
              "required":"true",
              "allowMultiple":"false",
              "dataType":"leadresponder_route",
              "name":"leadresponder_route",
              "paramType":"body"
            }
          ],
          "httpMethod":"PUT",
          "path":"\/{leadresponder_id}",
          "responseClass":"leadresonder_route",
          "summary":"Updates the existing leadresponder designated by the {leadresponder_id}"
        }
      ],
      "path":"\/leadresponder\/{leadresponder_id}"
    }
  ],
  "basePath":"http:\/\/org.local\/v1",
  "swaggerVersion":"0.1a",
  "apiVersion":"1",
  "path":"\/leadresponder",
  "value":"Gets collection of leadresponders",
  "description":"This is a long description of what it does",
  "produces":[
    "application\/json",
    "application\/json+hal",
    "application\/json-p",
    "application\/json-p+hal",
    "application\/xml",
    "application\/xml",
    "application\/xml+hal"
  ],
  "models":{
    "leadresonder_route":{
      "id":"leadresonder_route",
      "description":"some long description of the model",
      "properties":{
        "usr_mlr_route_id":{
          "type":"integer",
          "description":"some long winded description."
        },
        "route":{
          "type":"string",
          "description":"some long description of the model."
        },
        "createdDate":{
          "type":"string",
          "description":""
        },
        "tag":{
          "type":"string",
          "description":""
        },
        "arrayItem":{
          "type":"array",
          "description":""
        },
        "refArr":{
          "type":"array",
          "description":""
        },
        "enumVal":{
          "type":"array",
          "description":""
        },
        "integerParam":{
          "description":"This is an integer Param",
          "type":"integer"
        }
      }
    }
  }
}
JSON;
        $this->_apiFixture = json_decode($api, true);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Swagger_Resource::buildResource
     * @todo   Implement testBuildResource().
     */
    public function testBuildResource()
    {
        $path = realpath(dirname(__DIR__) . '/fixtures');
        $swagger = Swagger::discover($path);

        $resource = $swagger->getResource('http://org.local/v1');
        $this->assertEquals($this->_resourceFixture, json_decode((string) $resource, true));
        $api = $swagger->getApi('http://org.local/v1', '/leadresponder');
        $this->assertEquals($this->_apiFixture, json_decode((string) $api, true));
//         print_r($swagger->models->results);
    }

}
