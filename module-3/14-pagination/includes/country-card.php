<?php

// NOTE: This file will only work properly if we already have a record from the database to work with!

// Let's start by creating an array with all of the names of the continents instead of integers. 

$continents_key = array(
    1 => "Latin America",
    2 => "North America &amp; Oceania",
    3 => "Western Europe",
    4 => "Middle East",
    5 => "Africa",
    6 => "South Asia",
    7 => "Eastern Europe &amp; Central Asia",
    8 => "East Asia"
);

// Now that we have our key, let's 'translate' the integer to the continent's name.
$continent = $continents_key[$row['continent']];

// Next, population is expressed in the thousands, so let's make it a nicer number for the user. 
$population = $row['population'] * 1000;

?>

<!-- Card Output -->
<div class="card px-0">
    <div class="card-header text-bg-dark">
        <h3 class="card-title fw-light fs-5">
            <?= $row['country']; ?>
        </h3>
    </div> <!-- end of card header -->

    <div class="card-body">
        <!-- Ranking -->
         <p class="card-text"><span class="fw-bold">Ranking: </span>
            <?= $row['rank']; ?>
        </p>

        <!-- Continent -->
         <p class="card-text"><span class="fw-bold">Continent: </span>
            <?= $continent; ?>
        </p>

        <!-- Population -->
         <p class="card-text"><span class="fw-bold">Population: </span>
            <?= number_format($population); ?>
        </p>

        <!-- Life Expectancy -->
         <p class="card-text"><span class="fw-bold">Life Expectancy: </span>
            <?= $row['life_expectancy']; ?>
        </p>

        <!-- Wellbeing -->
         <p class="card-text"><span class="fw-bold">Wellbeing: </span>
            <?= $row['wellbeing']; ?>
        </p>

        <!-- Happy Planet Index -->
         <p class="card-text"><span class="fw-bold">Happy Planet Index: </span>
            <?= $row['hpi']; ?>
        </p>

        <!-- GDP (Per Capita) -->
         <p class="card-text"><span class="fw-bold">Gross Domestic Product (per Capita): </span>
            <?= "$" . number_format($row['gdp_per_capita']); ?>
        </p>
    </div> <!-- end of .card-body -->
</div> <!-- end of .card -->