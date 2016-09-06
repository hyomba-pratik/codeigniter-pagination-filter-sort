<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
		
	<div class="container" style="margin-top:75px;">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<input type="text" name="searchFor" placeholder="Search..." class="form-control" id="searchKey" onchange="sendRequest();">
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<select class="form-control" id="limitRows" onchange="sendRequest();">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><span>S/N</span></th>
				<th data-action="sort" data-title="Name" data-direction="ASC"><span>Name</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="CountryCode" data-direction="ASC"><span>CountryCode</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="District" data-direction="ASC"><span>District</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="Population" data-direction="ASC"><span>Population</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
			</tr>
		</thead>

			<?php 
				foreach ($citylist as $key => $city) {
					?>

					<tr>
						<td><?=($page+$key+1)?></td>
						<td><?=$city->Name;?></td>
						<td><?=$city->CountryCode;?></td>
						<td><?=$city->District;?></td>
						<td><?=$city->Population;?></td>
					</tr>

			<?php	}
			?>
			<tfoot>
					<tr>
				<th><span>S/N</span></th>
				<th data-action="sort" data-title="Name" data-direction="ASC"><span>Name</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="CountryCode" data-direction="ASC"><span>CountryCode</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="District" data-direction="ASC"><span>District</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
				<th data-action="sort" data-title="Population" data-direction="ASC"><span>Population</span> <i class="glyphicon glyphicon-triangle-bottom"></i></th>
			</tr>
		
			</tfoot>
		</table>
		<?php echo $pagination; ?>
	</div>

	<script type="text/javascript">
		var sendRequest = function(){
			var searchKey = $('#searchKey').val();
			var limitRows = $('#limitRows').val();
			window.location.href = '<?=base_url('welcome/index')?>?query='+searchKey+'&limitRows='+limitRows+'&orderField='+curOrderField+'&orderDirection='+curOrderDirection;
		}


		var getNamedParameter = function (key) {
            if (key == undefined) return false;

            var url = window.location.href;
            //console.log(url);
            var path_arr = url.split('?');
            if (path_arr.length === 1) {
                return null;
            }
            path_arr = path_arr[1].split('&');
            path_arr = remove_value(path_arr, "");
            var value = undefined;
            for (var i = 0; i < path_arr.length; i++) {
                var keyValue = path_arr[i].split('=');
                if (keyValue[0] == key) {
                    value = keyValue[1];
                    break;
                }
            }

            return value;
        };


        var remove_value = function (value, remove) {
            if (value.indexOf(remove) > -1) {
                value.splice(value.indexOf(remove), 1);
                remove_value(value, remove);
            }
            return value;
        };


        var curOrderField, curOrderDirection;
        $('[data-action="sort"]').on('click', function(e){
        	curOrderField = $(this).data('title');
        	curOrderDirection = $(this).data('direction');
        	sendRequest();
        });


        $('#searchKey').val(decodeURIComponent(getNamedParameter('query')||""));
        $('#limitRows option[value="'+getNamedParameter('limitRows')+'"]').attr('selected', true);

        var curOrderField = getNamedParameter('orderField')||"";
        var curOrderDirection = getNamedParameter('orderDirection')||"";
        var currentSort = $('[data-action="sort"][data-title="'+getNamedParameter('orderField')+'"]');
        if(curOrderDirection=="ASC"){
        	currentSort.attr('data-direction', "DESC").find('i.glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');	
        }else{
        	currentSort.attr('data-direction', "ASC").find('i.glyphicon').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');	
        }

	</script>
</body>
</html>