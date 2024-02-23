<?php

if (!function_exists("SearchBox")){
    function SearchBox($table_id) {
        echo "
        <div class='input-group col-4 bg-transparent'>
            <input type='text' name='searchBox' id='searchBox_{$table_id}' class='form-control' aria-describedby=''>
            <button class='input-group-text p-0 form-control col-sm-1 bg-light' id='searchButton_{$table_id}'>
                <i class='fa fa-search Center'></i>
            </button>
        </div>
        <script>
        $('#searchButton_{$table_id}').click(function() {
            const searchVal = $('#searchBox_{$table_id}').val().toLowerCase()
            $('#{$table_id} .searchTd').each(function() {
                if ($(this).html().toLowerCase().includes(searchVal)) {
                    $(this).parent().removeAttr('hidden')
                } else {
                    $(this).parent().attr('hidden', 'true')
                }
            })
        })
        </script>
        ";
    }
}   