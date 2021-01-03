<?php
	include 'head.php';
	include 'navbar_execution.php';
	?>


<script src="/REMIT/js/jquery.js" >	</script>
<script src="/REMIT/js/handsontable/1.0.0/handsontable.full.min.js" > </script>
<link href="/REMIT/css/bootstrap.min.css" rel="stylesheet">
<link href="/REMIT/js/handsontable/1.0.0/handsontable.min.css" rel="stylesheet">

<script>
var my_hot = undefined;
	$(document).ready(function() {
		var tab = document.getElementById("tableau");
		var dataJSON = [];

		$.ajax({
			type : "POST",
			url : "epurated_data.php",
			async : false,
			cache : false,
			success : function (msg) {
				dataJSON = JSON.parse(msg);
			}
		});

		cols = [];
		$.each(dataJSON[0], function(key, val) {
			cols.push(key);
		});

	    function ControlRenderer(){
	        return {
	            getRenderFunction: function(exeltiumCol, amountCol, cancelCol) {
	                return function(instance, td, row, col, prop, value, cellProperties){
	                    Handsontable.TextRenderer.apply(this, arguments);

	                    tdcheckExeltium = instance.getDataAtCell(row, exeltiumCol);
	                    tdcheckAmount = instance.getDataAtCell(row, amountCol);
	                    tdcheckCancel = instance.getDataAtCell(row, cancelCol);

	                    if("Exeltium" == tdcheckExeltium) {
	                        td.style['background-color'] = 'yellow';
	                    }
	                    if(0 >= tdcheckAmount) {
	                        td.style['background-color'] = 'orange';
	                    }
	                    if("" != tdcheckCancel) {
	                        td.style['background-color'] = 'red';
	                    }
	                    return td;
	                }
	            },

	        }
	    }

	  var controlRenderer = new ControlRenderer();

		var hotSettings = {
			data: dataJSON,
			rowHeaders: true,
			colHeaders: cols,
			contextMenu: true,
			cells: function (row, col, prop) {
			      var cellProperties = {};
			      cellProperties.renderer = controlRenderer.getRenderFunction(1, 38, 60);
			      
			      return cellProperties;
			    }
		};
		
		var hot = new Handsontable(tab, hotSettings);


		
		var buttons = {
			    file: document.getElementById('upload_data')
			  };
		var exportPlugin = hot.getPlugin('exportFile');


		buttons.file.addEventListener('click', function() {
		  exportPlugin.downloadFile('csv', {filename: 'userChangeDATA'});
		});
		my_hot = hot;
	    
	});

	function upload_hot() {
		var my_data = my_hot.getData();
		var data_post = { json: JSON.stringify(my_data)};

		$.ajax({
			type : "POST",
			data : data_post,
			url : "upload_json.php",
			async : false,
			cache : false,
			success : function (msg) {
				//console.log(msg);
				alert("Fichier bien mis en ligne !");
			}
		});
	}

</script>

<div id="tableau" class="handsontable"></div>

<button id="upload_data" class="intext-btn" onclick="upload_hot();">
  Save chages
</button>