<?php
$template = 'TagInclude.twig';
$includes = [
    'TagIncludeParagraph.twig',
    'TagIncludeGetVariables.twig',
    'TagIncludeSetVariables.twig',
    'TagIncludeOnly.twig'
];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the tag `include` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);