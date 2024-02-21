The project is a PHP application that reads data from a CSV file, processes it, and writes the summarized data to a new CSV file. 

---

Here's a brief overview of the main components:  

bootstrap.php
: This file contains a simple autoloader, which is responsible for loading the necessary classes when they are needed.  

config.php
: This file contains the basic configuration for the application. It specifies the location of input and output files, the available formats, and the parsers that should handle those formats. It also specifies a mapping between file headers and model properties. The group_by array in this file specifies which properties should be used to group models by.  

splp.php
: This is the entry point of the application. It loads the autoloader from bootstrap.php and runs the application defined in the App class.  

App class
: This class is the main class of the application, responsible for orchestrating the reading, processing, and writing of data.  

ParserInterface
: This is an interface that all parsers must implement. Parsers are responsible for handling specific formats.  

CsvParser
: Is responseible fore reading CSV data, creating models based on that data, and calculating "counts" for summary report. Additional classes to handle other formats could be added at a later date.

Model class
: This is a base class for all models. Models represent the data that the application works with. This base abstract class has a function to make instances of model classes based on supplied data and a header map.

Products model
: This is a specific model that represents products. Additional models with different set of properties could be added at a later date.

The application can be run from the command line with the command `php splp.php <input file> <output file>`. For example, `php splp.php products_comma_separated.csv test.csv`.


---
I've also added a test class for Configuration class in tests/ConfigurationTest.php as an exmample, but without 3rd party libraries such as PHPUnit, I'm afraid that writing a testing system from scratch would fall outside of the requirements for this task.