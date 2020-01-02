<div class="modal-dialog modal-lg">
    <div class="modal-content" id="DivIdToPrint">
        <div class="modal-header">
            <h4>Evaluación Supervisor</h4>
            <div class="col-1">
                <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
            </div>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i style="color: red;" class="fas fa-times"></i></span>
            </button>
        </div>
        
    </div>
</div>
<script type="text/javascript">



    function printtag(tagid) {
        var hashid = "#"+ tagid;
        var tagname =  $(hashid).prop("tagName").toLowerCase() ;
        var attributes = "";
        var attrs = document.getElementById(tagid).attributes;
        $.each(attrs,function(i,elem){
            attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
        })
        var divToPrint= $(hashid).html() ;
        var head = "<html><head>"+ $("head").html() + "</head>" ;
        var allcontent = head + "<body  onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "<" + tagname + ">" +  "</body></html>"  ;
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
        // setTimeout(function(){newWin.close();},10);
    }
</script>

