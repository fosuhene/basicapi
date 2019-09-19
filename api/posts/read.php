<?php
    //add the necessary headers since it and restful http request
    header('Access-Control-Allow-Origin: *');  // * means it is a public accessible api
    header('Content-Type: application/json');

    include_once('../../config/Basecon.php');
    include_once('../../models/Post.php');

    //instantiate database object
    $database = new Database();
    $db = $database->connect();

    //instantiate blog post object
    $post = new Post($db);

    //blog post query
    $result = $post->read();

    //get row count
    $row_num = $result->rowCount();

    //check if any post exist
    if($row_num > 0){
        //if there is, initialize array

        $posts_arr = array();
        $posts_arr['data'] = array();

        //create a while loop from the post result
        while($row = $result->fetch(PDO::FETCH_ASSOC)){

            //instead of $row['title'],  let's use extract to extract all row data
            extract($row);

            //create post item for each post
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
                //'createdAt' => $creted_at
            );

            //push grabed post_items to the data
            array_push($posts_arr['data'], $post_item);
        }

         //convert out to json
          echo json_encode($posts_arr);
    }else{
        //No posts found
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }

 ?>