<?php

if( isset($_POST['collezione']) ) {

    if (isset($_POST['collezione'])){
        $id_collezione = $_POST['collezione'];
    }

    echo '
    <div class = "row justify-content-center">
        <table>
            <thead>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Min Price</th>
                <th>Trend Price</th>
                <th>24h %</th>
                <th>7d %</th>
                <th>Count Articles</th>
                <th>Count Foils</th>
                <th>Count Wanted</th>
                <th>Expected Market Cap</th>
                <th>Sentimento</th>
            </thead>

            <tr>
                <td>#</td>
                <td>I</td>
                <td>N</td>
                <td>M</td>
                <td>T</td>
                <td>2</td>
                <td>7</td>
                <td>C</td>
                <td>C</td>
                <td>C</td>
                <td>E</td>
                <td>S</td>
            </tr>
        </table>
    </div>
    
    
    
    ';

}



function get_things($id_collezione){

    return $id_collezione;
}