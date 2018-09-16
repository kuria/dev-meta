Kuria development meta
######################

Common development dependencies and scripts for Kuria libraries.

.. contents::


Requirements
************

- PHP 7.1+


Usage
*****

Composer scripts
================

This package defines the following composer scripts:

- ``composer all`` - run codestyle checks and tests
- ``composer tests`` - run tests
- ``composer coverage`` - run tests and generate code coverage report
- ``composer cs`` - run codestyle checks
- ``composer cs:fix`` - attempt to automatically fix codestyle violations

Run the ``composer package-scripts:list`` to show commands to only run specific tools.


Base test class
===============

The ``Kuria\DevMeta\Test`` class should be extended instead of ``PHPUnit\Framework\TestCase``.

It provides access to additional features from `kuria/phpunit-extras <https://github.com/kuria/phpunit-extras>`_.

.. code:: php

   <?php

   namespace Acme;

   use Kuria\DevMeta\Test;

   class ExampleTest extends Test
   {
       // ...
   }
