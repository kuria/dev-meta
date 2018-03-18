Kuria development meta
######################

Common Kuria library development dependencies and scripts.


Installation
************

.. code:: javascript

   {
       "name": "acme/example",
       // ...
       "require-dev": {
           "kuria/dev-meta": "^0.1.0"
       }
   }


Usage
*****

This package defines the following main scripts:

- ``composer all`` - run codestyle checks and tests
- ``composer tests`` - run tests
- ``composer coverage`` - run tests and generate code coverage report
- ``composer cs`` - run codestyle checks
- ``composer cs:fix`` - attempt to automatically fix codestyle violations

Run the ``composer package-scripts:list`` to show commands to run specific tools.