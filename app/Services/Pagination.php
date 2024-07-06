<?php

namespace App\Services;

class Pagination
{
    public static function links($paginator)
    {

        if ($paginator->hasPages()) {
            echo '<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between my-4">';

            // Previous Page Link
            if ($paginator->onFirstPage()) {
                echo '<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">' . "previous" . '</span>';
            } else {
                echo '<a href="' . $paginator->previousPageUrl() . '" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="' . "pagination.previous" . '">' . "previous" . '</a>';
            }

            // Next Page Link
            if ($paginator->hasMorePages()) {
                echo '<a href="' . $paginator->nextPageUrl() . '" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="' . "pagination.next" . '">' . "next" . '</a>';
            } else {
                echo '<span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">' . "next" . '</span>';
            }

            echo '</nav>';
        }
    }
}