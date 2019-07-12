<?php
include_once('db.php');

if(isset($_POST)){
    
    if(isset($_POST['fetch'])){//if fetch is set then all entries will be fetched
    
        $sql = "SELECT * FROM items";
        $get_query = $conn->query($sql);
        $get_query->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $get_query->fetch()): 
            echo "<tr><td> ".$row['name']."</td><td>". $row['unit']."</td><td>". $row['rate']."</td></tr>";
        endwhile;
         
    }else{
        $where = 'WHERE ';
    
        if(isset($_POST['item_name'])){
    
            $item_name = $_POST['item_name'];
            $where .= ' name IN("'.implode('", "',$item_name).'") ';
            if(isset($_POST['item_unit'])){
                $where .= ' AND ';
            }
        }
    
        if(isset($_POST['item_unit'])){
    
            $item_unit = $_POST['item_unit'];
            $where .= ' unit = '.$item_unit;
    
        }
    
        if(isset($_POST['min_price']) || isset($_POST['max_price'])){
            if(isset($_POST['item_unit']) || isset($_POST['item_name'])){
                $where .= ' AND ';
            }
            $min_price = $_POST['min_price'];
            $max_price = $_POST['max_price'];
            $where .= ' rate <='.$max_price.' AND rate >='.$min_price;
        }

        if(isset($_POST['sort_by_price'])){
            $where .= ' ORDER BY rate DESC';
        }else{
            $where .= ' ORDER BY rate ASC';

        }
    
        $sql = "SELECT * FROM items ".$where;
        $get_query = $conn->query($sql);
        $get_query->setFetchMode(PDO::FETCH_ASSOC);
    
        while ($row = $get_query->fetch()): 
            echo "<tr><td> ".$row['name']."</td><td>". $row['unit']."</td><td>". $row['rate']."</td></tr>";
        endwhile;
    }


}
?>