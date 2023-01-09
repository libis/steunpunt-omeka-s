# Solarium PHP Solr Client Library

## What is Solarium?

Solarium is a PHP Solr client library that accurately model Solr concepts. Where many other Solr libraries only handle
the communication with Solr, Solarium also relieves you of handling all the complex Solr query parameters using a
well documented API.

Please see the [docs](http://solarium.readthedocs.io/en/stable/) for a more detailed description.

## Requirements

Solarium 6.x only supports PHP 7.2 and up.

It's highly recommended to have Curl enabled in your PHP environment. However if you don't have Curl available you can
switch from using Curl (the default) to a pure PHP based HTTP client adapter which works for the essential stuff but
doesn't support things like parallel query execution.

Alternatively you can inject any PSR-18 compatible HTTP Client using the `Psr18Adapter`.

## Getting started

The preferred way to install Solarium is by using Composer. Solarium is available on
[Packagist](https://packagist.org/packages/solarium/solarium).

Example:
```
composer require solarium/solarium
```

### Pitfall when upgrading from 3.x or 4.x or 5.x

Setting "timeout" as "option" in the HTTP Client Adapter is deprecated since Solarium 5.2.0 because not all adapters
could handle it. The adapters which can handle it now implement the `TimeoutAwareInterface` and you need to set the
timeout using the `setTimeout()` function after creating the adapter instance.

In order to fix some issues with complex queries using local parameters solarium 6 destinguishs between query parameters
and local parameters to be embedded in a query. Solarium 5.2 already informed you about the deprecation of some
parameter names which are in fact local parameters. Solarium doen't convert them magically anymore.
Local parameter names now have to be prefixed with `local_` if set as option of a constructor.

Solarium 5:
```php
$categoriesTerms = new Solarium\Component\Facet\JsonTerms(['key' => 'categories', 'field' => 'cat', 'limit'=>4,'numBuckets'=>true]);
```

Solarium 6:
```php
$categoriesTerms = new Solarium\Component\Facet\JsonTerms(['local_key' => 'categories', 'field' => 'cat', 'limit'=>4,'numBuckets'=>true]);
```

See https://lucene.apache.org/solr/guide/local-parameters-in-queries.html for an introduction about local parameters.


### Pitfall when upgrading from 3.x or 4.x

In the past, the V1 API endpoint **_solr_** was not added automatically, so most users set it as path on the endpoint.
This bug was discovered with the addition of V2 API support. In almost every setup, the path has to be set to `/`
instead of `/solr` with this release!

For the same reason it is a must to explicit configure the _core_ or _collection_.

So an old setting like
```
'path' => '/solr/xxxx/'
```
has to be changed to something like
```
'path' => '/',
'collection' => 'xxxx',
```

## Run the examples

To run the examples read through the _Example code_ section of
https://solarium.readthedocs.io/en/stable/getting-started/

## Run the tests

The phpunit tests contain some integration tests that require a running Solr instance. And this Solr instance requires
some special configuration.
Have a look at `.github/workflows/run-tests.yml` to see how to start a well configured Solr docker container locally.
If you just want to run the unit tests, just ensure that there's no other Solr server listening on the standard port
8983 and the integration tests will be skipped.

## More information

* Docs
  http://solarium.readthedocs.io/en/stable/

* Issue tracker   
  http://github.com/solariumphp/solarium/issues

* Contributors    
  https://github.com/solariumphp/solarium/contributors

* License   
  See the COPYING file or view online:  
  https://github.com/solariumphp/solarium/blob/master/COPYING

## Continuous Integration status

* [![Run Tests](https://github.com/solariumphp/solarium/workflows/Run%20Tests/badge.svg)](https://github.com/solariumphp/solarium/actions)
* [![codecov](https://codecov.io/gh/solariumphp/solarium/branch/master/graph/badge.svg)](https://codecov.io/gh/solariumphp/solarium)
* [![SensioLabsInsight](https://insight.sensiolabs.com/projects/292e29f7-10a9-4685-b9ac-37925ebef9ae/small.png)](https://insight.sensiolabs.com/projects/292e29f7-10a9-4685-b9ac-37925ebef9ae)
* [![Total Downloads](https://poser.pugx.org/solarium/solarium/downloads.svg)](https://packagist.org/packages/solarium/solarium)
