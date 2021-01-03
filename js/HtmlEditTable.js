/*

public class HtmlEditTable {

  public:
  
  HtmlEditTable(object o);
  void AppendTo(control parent);
  Array LineNames();
  Array LineNames(Array t);
  Array ColumnNames();
  Array ColumnNames(Array t);
  object Dimensions();
  object Dimensions(object d);
  Array Line();
  Array Line(object o);
  Array Column();
  Array Column(object o);
  void Clean();
  void Populate(Array data);
  void Build(object o);
  T Data(string col, string row);
  T Data(string col, string row, T data);
  Array AllData();
};

*/



var HtmlEditTable = null;

(function(){
	HtmlEditTable = function(){				
	  this.control = document.createElement("table");
	  this.control.cellSpacing = 0;
	  this.control.cellPadding = 0;
	  this.control.className = "HtmlEditTable";
	
	  if (arguments.length > 0){
	    this.Build(arguments[0]);
	  }
	};
	
	HtmlEditTable.prototype = {
		Build: function(){
		  if (arguments.length > 0){
		    this.Clean();
		
		    var o = arguments[0];
		
		    this.Dimensions(o);
		
		    if (o.Xn){
		      this.columns = o.Xn;
		    }
		
		    if (o.Yn){
		      this.lines = o.Yn;
		    }
		
		    if (o.head){
		      this.headers = o.head;
		    }
		
		    if (o.caption){
		      this.caption = o.caption;
		    }
		
		    if (o.data){
		      this.Populate(o.data);
		    }
		    else {
		      this.Populate();
		    }
		  }
		},
		Clean: function(){
		  Tools.Purge(this.control);			
		  this.columns = [];
		  this.lines = [];
		  this.headers = [];
		  this.caption = "";
		},
		Dimensions: function(){
		  if (arguments.length > 0){
		    this.columns = [];
		    this.lines = [];
		
		    if (arguments[0].X){
		      for (var i=0, imax=arguments[0].X; i<imax; i++){
		        this.columns.push("" + i);
		      }
		    }
		    if (arguments[0].Y){
		      for (var i=0, imax=arguments[0].Y; i<imax; i++){
		        this.lines.push("" + i);
		      }
		    }
		  }
		  return { "x": this.columns.length, "y": this.lines.length };
		},
	  Populate: function(){
		  if (this.caption){ this.control.createCaption().appendChild(document.createTextNode(this.caption));
		  }
				
		  if (this.lines.length > 0){	
		    for (var i=0, Y=this.lines.length; i<Y; i++){
		      var row = this.control.insertRow(i);
		
		      if (this.columns.length > 0){
		        for (var j=0, X=this.columns.length; j<X; j++){
		          var cell = row.insertCell(j);
		          if (arguments.length > 0){
		            HtmlEditTableHelper.CellInitialize(cell, arguments[0][j+i*X]);
		          }
		        }
		      }
		    }
		  }
					
		  if (this.headers.length == this.columns.length){
		    var tHead = this.control.createTHead();
		    var row = tHead.insertRow(0);
		    for (var i=0, imax=this.headers.length; i<imax; i++){
		      var cell = row.insertCell(i);
		   cell.appendChild(document.createTextNode(this.headers[i]));
		    }
		  }
	  },
	  AppendTo: function(parent){
	    parent.appendChild(this.control);
	  },  
	  AllData: function(){
		  var data = [];
		  var rows = this.control.getElementsByTagName("tbody")[0].rows;
		  for (var y=0, ymax=rows.length; y<ymax; y++){
		    var cells = rows[y].cells;
		    for (var x=0, xmax=cells.length; x<xmax; x++){
		      data.push(cells[x].firstChild.data);
		    }
		  }
		  return data;
		},	
	  LineNames: function(){
		  if (arguments.length > 0){
		    this.lines = lines;
		  }
		  return this.lines;
		},   
	  ColumnNames: function(){
	    if (arguments.length > 0){
	      this.columns = columns;
	    }
	    return this.columns;
	  },
		Line: function(){
		  if (arguments.length == 0
		    || typeof arguments[0].name == "undefined"){
		    return undefined;
		  }
		
		  var data = [];
		  var y = Tools.IndexOf(this.lines, arguments[0].name);
		
		  if (y > -1){
		    var cells = this.control.getElementsByTagName("tbody")[0].rows[y].cells;
		
		    if (typeof arguments[0].data != "undefined"){
		      data = arguments[0].data;
		      for (var i=0, imax=data.length; i<imax; i++){
		        cells[i].firstChild.data = data[i];
		      }
		    }
		    else{
		      for (var x=0, xmax=cells.length; x<xmax; x++){
		        data.push(cells[x].firstChild.data);
		      }
		    }
		  }
		  else if (typeof arguments[0].data != "undefined"){
		    this.lines.push(arguments[0].name);
		    data = arguments[0].data;
		
		    var row = this.control.insertRow(-1);
		    for (var j=0, jmax=this.columns.length; j<jmax; j++){
		      var cell = row.insertCell(-1);
		      HtmlEditTableHelper.CellInitialize(cell, data[j]);
		    }
		  }
		
		  return data;
		},   
		Column: function(){
		  if (arguments.length == 0
		    || typeof arguments[0].name == "undefined"){
		    return undefined;
		  }
		
		  var data = [];
		  var rows = this.control.getElementsByTagName("tbody")[0].rows;
		  var x = Tools.IndexOf(this.columns, arguments[0].name);
		
		  if (x > -1){
		    if (typeof arguments[0].data != "undefined"){
		      data = arguments[0].data;
		      for (var i, imax=data.length; i<imax; i++){
		        rows[i].cells[x].firstChild.data = data[i];
		      }
		    }
		    else{
		      this.lines.push(arguments[0].name);
		      for (var y=0, ymax=rows.length; y<ymax; y++){
		        data.push(rows[y].cells[x].firstChild.data);
		      }
		    }
		  }
		  else if (typeof arguments[0].data != "undefined"){
		    this.columns.push(arguments[0].name);
		    data = arguments[0].data;
		
		    for (var y=0, ymax=rows.length; y<ymax; y++){
		      var cell = rows[y].insertCell(-1);
		      HtmlEditTableHelper.CellInitialize(cell, data[y]);
		    }
		
		    var thead = this.control.getElementsByTagName("thead");
		    if (thead.length > 0){
		      thead = thead[0];
		      var title = typeof arguments[0].head != "undefined" ? arguments[0].head : "";
		      var cell = thead.rows[0].insertCell(-1);
		      cell.appendChild(document.createTextNode(title));
		    }
		  }
		
		  return data;
		},
		Data: function(column, line, data){
		  if (arguments.length < 2){
		    return undefined;
		  }
		  var x, y;
		  x = Tools.IndexOf(this.columns, arguments[0]);
		  if (x > -1){
		    y = Tools.IndexOf(this.lines, arguments[1]);
		    if (y > -1){
		      if (arguments.length > 2){
		        this.control.rows[y].cells[x].appendChild(document.createTextNode(arguments[2]));
		      }
		      return this.control.rows[y].cells[x].firstChild.data;
		    }
		  }
		  return undefined;
		}
	};

	var HtmlEdit = function(value){
	  var loseFocus = function(e){
	    var src = Tools.Target(e);
	    var cell = Tools.Node(src, "TD");
	    Tools.Purge(cell);
	    HtmlEditTableHelper.CellInitialize(cell, src.value);
	  };
	
	  this.control = document.createElement("input");
	  this.control.type = "text";
	  this.control.className = "HtmlEdit";
	  this.control.onblur = loseFocus;
	  this.control.onkeydown = function(e){
	    if (Tools.KeyCode(e) == 13){
	      loseFocus(e);
	    }
	  };
	
	  this.control.value = value;
	};
	
	HtmlEdit.prototype = {
	  AppendTo: function(parent){
	    if (document.all){
	      this.control.style.height = parent.clientHeight - 2*parent.clientTop + "px";
	      this.control.style.width = parent.clientWidth - 2*parent.clientLeft + "px";
	    }
	    else{
	      this.control.style.height = parent.offsetHeight - 2*parent.clientTop + "px";
	      this.control.style.width = parent.offsetWidth - 2*parent.clientLeft + "px";
	    }
	    Tools.Purge(parent);    
	    parent.appendChild(this.control);
	
	    this.control.select();
	    this.control.focus();
	  }
	};
		
	var HtmlEditTableHelper = {
		CellInitialize: function (cell, value){
			if (cell){
	      cell.ondblclick = HtmlEditTableHelper.DblClickHandler;
	      if (typeof value != "undefined"){
	        cell.appendChild(document.createTextNode(value));
	      }
	    }
	  },
	
		DblClickHandler: function(e){
	    var src = Tools.Node(Tools.Target(e), "TD");
	    if (!src){
	      Tools.Event(e).returnValue = false;
  	    return false;
	    }
	    var htmlEdit = new HtmlEdit(src.firstChild.data);
	    htmlEdit.AppendTo(src);
	    src.ondblclick = null;
	  }
	};
	
	var Tools = {
	  Purge: function(node){
	    while (node && node.hasChildNodes()){
	      var child = node.firstChild;
	      Tools.Purge(child);
	      var attr = child.attributes;
	      if (attr) {
  	      var n;
	        var l = attr.length;
	        for (var i=0; i<l; i++){
	          n = attr[i].name;
	          if (typeof child[n] === 'function') {
	            child[n] = null;
	          }
	        }
	      }
	      child = null;
	      node.removeChild(node.firstChild);
	    }
	  },
	
	  Node: function(o, nodeName){
	    while(o && o.nodeName != nodeName.toUpperCase()){
	      o = o.parentNode;
	    }
	    if (o){
        return o; 
	    }
	    return undefined;   	
	  },
	
	  Event: function(e){
	    return window.event || e;
	  },
	
	  Target: function(e){
	    e = Tools.Event(e);
	    return e.srcElement || e.target;
	  },
	
	  KeyCode: function(e){
	    e = Tools.Event(e);
	    return e.keyCode || e.which;
	  },
	
	  IndexOf: function(array, value){
	    for (var i=0, imax=array.length; i<imax; i++){
	      if (i in array && array[i] === value){
	        return i;
	      }
	    }
	    return -1;
	  }
	};
})();