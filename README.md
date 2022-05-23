# ModelFlags
====================

This ligrary helps you to add flags support to your models, entities etc.

## Installation

    $ composer require dmytrof/model-flags 

## Usage

    class Blog implements ModelWithFlagsInterface 
    {
        use ModelWithFlagsTrait;

        public const SOME_FLAG1 = 1;
        public const SOME_FLAG2 = 'FLAG_2';

        ...............
    };

    $blog = new Blog();
    $blog->hasFlag(Blog::SOME_FLAG1); // false

    // Add flags
    $blog
        ->setFlag(Blog::SOME_FLAG1)
        ->setFlag(Blog::SOME_FLAG2)
        ->setFlag('myFlag', false)
    ; 

    // Get flugs
    $flags = $blog->getFlugs(); // [1 => true, 'FLAG_2' => true, 'myFlag' => false]

    // Check flag
    $blog->hasFlag(Blog::SOME_FLAG1); // true
    $blog->hasFlag('myFlag'); // false
    
    $blog->popFlag(Blog::SOME_FLAG2); // true
    $blog->popFlag(Blog::SOME_FLAG2); // false

    // Remove flag
    $blog->removeFlag('myFlag');

    $flags = $blog->getFlugs(); // [1 => true]
        
        