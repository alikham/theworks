<!DOCTYPE html>
<html>
<head>
    <title>Filter and Sort</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
</head>
<body>

<form id="filter_parameters" method="post" >
        <label for="product_1">A<input type="checkbox" name="item_name[]" value="A" id="product_1"></label>
        <label for="product_2">B<input type="checkbox" name="item_name[]" value="B" id="product_2"></label>
        <label for="product_3">C<input type="checkbox" name="item_name[]" value="C" id="product_3"></label>

        <label for="unit_1">1<input type="radio" name="item_unit" value="1" id="unit_1"></label>
        <label for="unit_2">2<input type="radio" name="item_unit" value="2" id="unit_2"></label>
        
        <input type="hidden" name="min_price" id="min_price">
        <input type="hidden" name="max_price" id="max_price">
        
        <label for="sort">Sort By Price/Rate<input type="checkbox" name="sort_by_price[]" value="sort" id="sort"></label>

        <p>
        <label for="amount">Price range:</label>
        <input type="text" name="price" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
        <div id="slider-range"></div>
        </p>      
</form>

 <table class="table table-bordered" id="entry-list">
     <thead>     
        <tr>
             <th>Name</th>
             <th>Unit</th>
             <th>Rate</th>
         </tr>
     </thead>
     <tbody></tbody>
 </table>
</body>

<script>
$(document).ready(function(){

//Load all entries by passing the fetch parameter
$.ajax({ 
    type:'POST',
    url: 'controller.php',
    data : {'fetch': 1},
    success : function(data){
        $("tbody").html(data);
    }
});

//For the two thumb slider
$( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 30,
    values: [ 0, 30 ],
    slide: function( event, ui ) {
    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    $("#min_price").val(ui.values[ 0 ]);   
    $("#max_price").val(ui.values[ 1 ]);   
    },
    change:filter_function     
});

//For displaying the prices on load of the page
$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

$("#min_price").val($( "#slider-range" ).slider( "values", 0 ));
$("#max_price").val($( "#slider-range" ).slider( "values", 1 ));

$("#filter_parameters").on("input", filter_function);


function filter_function(){
    //On recieving any input from the user 
    // Serialize all the input data which will be sent to the controller
    var filter_data = $("#filter_parameters").serialize();

    $.ajax({
        type:'POST',
        url:'controller.php',
        data: filter_data,
        success: function(data){
                if(data){
                    $("tbody").html(data);
                }else{
                    $("tbody").html("<tr><td colspan='3'>No results found</td></tr>");
                }
            }
        });
    
}
});

</script>
</html>