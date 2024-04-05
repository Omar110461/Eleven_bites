<?php

function validat_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $recipeCategories = array(
    "Appetizers",
    "Breakfast",
    "Lunch",
    "Dinner",
    "Desserts",
    "Salads",
    "Soups",
    "Snacks",
    "Beverages",
    "Bakery",
    "Grilling",
    "Vegetarian",
    "Vegan",
    "Gluten-Free",
    "Low-Carb",
    "Paleo",
    "Keto"
);