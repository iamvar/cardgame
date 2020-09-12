# Tweny one

## Description

This is the simple php console application with symfony/console to play card game **21**.

You have randomly shuffled deck of 52 cards (4 cards of each kind - 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A)

Each card has value associated with it:

| 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | J  | Q  | K  | A |
|---|---|---|---|---|---|---|---|----|----|----|----|---|
| 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 11 | 11 | 1 |

### Goal

You have to pick cards to be as close to 21 as possible and have higher score than opponent.

## Installation and Usage
To run application:

### Installation
composer require iamvar/cardgame

### Run
bin/console game:21