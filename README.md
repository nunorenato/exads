# EXADS PHP Developer Exercise

## 1. Prime numbers

> Write a PHP script that prints all integer values from 1 to 100.
Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
only multiple of itself then print “[PRIME]”

Solution under:

    primes/primes.php

A simple script for the intended task. For each of the numbers we only need to test up
to its square root, thus achieving complexity *O(n\*sqrt(n))*.

## 2. ASCII Array

> Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
Write the code to efficiently determine the missing character.

Solution under:

    ASCII/ascii.php

It works by comparing the array with the missing element with an original array using `array_diff` 
for better performance.

## 3. TV series

> Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
> > tv_series -> (id, title, channel, gender);
> >
> > tv_series_intervals -> (id_tv_series, week_day, show_time);
> 
>  Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
>  inputted time-date, and that can be optionally filtered by TV Series title.

Solution under:

    tv/

For this exercise I decided to use the framework *Laravel*. It might be a bit of an overkill for such a 
small project, but it wouldn't make sense to code a proper DB layer when this framework already
do it, along with many useful features. Besides, a real world project wouldn't be as small as this and would make it worth it.

The tables' schema and mock data can be found on the file:
> schema.sql

The action can be called on the route `next/`, with the optional parameters *date* and *series*. Example:
> /next?date=2023/06/12 08:00&series=Succession

The main logic is under `app\Http\Controllers\ScheduleController.php`, where through a single query it can
provide the next show, based on the filters.

I've created a helper class `ScheduleTime` to handle the conversions between real world dates and times and
the generic ones of the stored intervals. The date filter can be in any kind of readable date format.

Having used *Laravel* is now very easy to create methods to retrieve, update or create new shows and intervals.

### Testing

Under `tests\Feature\ScheduleControllerTest.php` there is a test suite.

### Improvements

Have a config setting for the output date format.

## A/B Testing

> Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
Write a snippet of PHP code that redirects end users to the different designs based on the data
provided by this library: packagist.org/exads/ab-test-data

Solution under:

    abtesting

The class `DesignManager` is the one that handles most of the work. It collects the designs
and stores some internal data structures and variables to quickly and more efficiently provide answers
without having to go through all the records everytime.

### Testing

Under `tests\Feature\DesignManagerTest.php` there is a test suite.

