
<?php
/**
 * Created by PhpStorm.
 * User: invictus
 * Date: 2017/12/20
 * Time: 上午12:10
 */
//get the value of init to switch to different commits project

function getjson($input)
{
    $ch = curl_init();
    $timeout = 10000;
    curl_setopt($ch,CURLOPT_USERAGENT,'invictuschen');
    curl_setopt($ch,CURLOPT_URL,'https://api.github.com/user');
    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        'Authorization','Basic'
    ));
    curl_setopt ($ch, CURLOPT_URL, $input);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    return json_decode($file_contents);
}
$api=$_GET['init'];
$obj=getjson($api);
$cdate=0;//for the filter date calculation
$collapseid=0;//the id of the collapse part

echo '<div class="col-sm-8" style="margin-top: 20px;margin-left: 300px">';
echo  '<table class="table table-hover"><tr bgcolor="#f8f8ff"><th><td><h2 style="margin-left: 35%;">User Commit List</h2></td></th></tr><tbody>';
foreach($obj as $key)
{
    $mes=explode("\n",$key->commit->message);//commit title
    $fir=explode(" ",$key->commit->author->name);
    $sfir=explode(" ",$key->commit->committer->name);
    $date=explode("T",$key->commit->committer->date);
    if($cdate!=$date[0])
    {
        echo '<tr bgcolor="#d3d3d3"><th><td>';
        echo 'Commits on ';
        echo $date[0];
        $cdate=$date[0];
        echo '</td></th></tr>';
    }
        echo '<tr><th scope="row"><td colspan="2">';

    if($key->author!=null)
    {
        echo '<a target="_blank" href=' . $key->author->html_url . '><img src=' . $key->author->avatar_url . ' width="50px" height="50px" class="img-circle"/></a>';
    }
        else echo '<a target="_blank" href='.$key->html_url.'><img src=failimage.php class="img-circle"/></a>';

//    $inx=getjson($obj->url); to get the patchs api
//        $file=$inx->files;
        echo '<li style="font-size:12px;display: inline-block;"><span style="margin-left: 5px;">'.$fir[1].'</span><span> committed</span>';
        if($key->commit->author->name!=$key->commit->committer->name)
            if($key->committer!=null)
            echo ' with <img src='.$key->committer->avatar_url.'width="30px" height="30px" class="img-circle"/>'.$sfir[1].'';
        else echo ' with <img src=failimage.php width="30px" height="30px" class="img-circle"/>'.$sfir[1].'';
        echo '<span style="font-size:13px;margin-bottom: 20px;"> on '.$date[0].'</span></li>';
    echo '<div class="panel-group" id="accordion" style="margin-left: 35px;">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#'.$collapseid.'">
					'.$mes[0].'
				</a>
			</h4>
		</div>
		<div id="'.$collapseid.'" class="panel-collapse collapse">
			<div class="panel-body" style="background-color: #e8f2f2;"><h3>Commit Information:</h3>';

            //message part
            foreach ($mes as $key1)
            {
                echo '<div id="commitinfo" >';
                echo $key1;
                echo '</div>';
            }
//    //this is for the patch information, but due to the limit of the Github api request, I have to change it to a single request outside the loop.
//				foreach($file as $key)
//                {
//                    echo '<div id="patches">';
//                    echo '<pre>"patch:"'.$key->filename.'';
//                    $word=explode("\t",$key->patch);
//                    foreach ($word as $key1)
//                    {
//                        echo '<br>';
//                        echo $key1;
//                        echo '</br>';
//                    }
//                    echo  '</pre>';
//                }

        echo '</div>
		</div>
	</div>';
    $collapseid++;
    echo '<div class="panel">SHA:'.$key->sha.' <a href="'.$key->html_url.'" style="margin-left: 350px;">More details</a></div>';
        echo  '</td></th>';
        echo '</tr>';
}
echo '</tbody></table>';
echo '</table></div>';
?>
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>




