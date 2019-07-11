<!DOCTYPE html>
<html>
<head>
    <title>Filter and Sort</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>
<body>

<form id="filter_parameters" method="post" >
        <label for="product_1">A<input type="checkbox" name="item_name[]" value="A" id="product_1"></label>
        <label for="product_2">B<input type="checkbox" name="item_name[]" value="B" id="product_2"></label>
        <label for="product_3">C<input type="checkbox" name="item_name[]" value="C" id="product_3"></label>

        <label for="unit_1">1<input type="radio" name="item_unit" value="1" id="unit_1"></label>
        <label for="unit_2">2<input type="radio" name="item_unit" value="2" id="unit_2"></label>
        
        <input type="range" id="price_range" name="price" min="0" max="30" > 
        <label for="sort">Sort By Price/Rate<input type="checkbox" name="sort_by_price[]" value="sort" id="sort"></label>
        
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

$("#price_range").val('30');

//Load all entries by passing the fetch parameter
$.ajax({ 
    type:'POST',
    url: 'controller.php',
    data : {'fetch': 1},
    success : function(data){
        $("tbody").html(data);
    }
});


$("#filter_parameters").on("input", function(){
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
    });
});

</script>
</html>