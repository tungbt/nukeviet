<!-- BEGIN: first -->
	<a class="button1" href="{ADD_NEW}"><span><span>{LANG.add_menu}</span></span></a>
<!-- BEGIN: table -->
<table summary="" class="tab1">
    <thead>
        <tr align="center">
            <td>
                <strong>{LANG.number}</strong>
            </td>
            <td>
                <strong>{LANG.name_block}</strong>
            </td>
            <td>
                <strong>{LANG.menu}</strong>
            </td>
            <td>
                <strong>{LANG.menu_description}</strong>
            </td>                   
                        
            <td>
                 <strong>{LANG.action}</strong>
            </td>
        </tr>
    </thead>
    <!-- BEGIN: loop1 -->
    <tbody {DATA.class}>
        <tr>
            <td align="center">
                {ROW.nb}
            </td>
            <td>
            	<a href="{ROW.link_view}" title="{ROW.title}"><strong>{ROW.title}</strong></a>               
            </td>
           	<td>
                {ROW.menu_item}                
            </td>
           	<td>
                {ROW.description}                
            </td>        
            
             <td align="center">
                <span class="edit_icon"><a href="{ROW.edit_url}">{LANG.edit}</a></span>&nbsp;-&nbsp;<span class="delete_icon"><a href="javascript:void(0);" onclick="nv_link_del({ROW.id},{ROW.num});">{LANG.delete}</a></span>
                <script type="text/javascript">
	            	var block= '{LANG.block}';
	            	var block2= '{LANG.block2}';
            	</script>
            </td>
           </tr>
    </tbody>
     <!-- END: loop1 -->
	
    <!-- BEGIN: generate_page -->
    <tr class="footer">
        <td colspan="8">
            {GENERATE_PAGE}
        </td>
    </tr>
    <!-- END: generate_page -->
</table>
<!-- END: table -->
<!-- END: first -->

<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="quote" style="width:780px;">
    <blockquote class="error">
        <span>{ERROR}</span>
    </blockquote>
</div>
<div class="clear">
</div>
<!-- END: error -->
<form action="{FORM_ACTION}" method="post">
    <input type="hidden" name ="id" value="{DATAFORM.id}" /><input name="save" type="hidden" value="1" />
    <table summary="" class="tab1">
        <caption>
            {LANG.add_menu}
        </caption>
        <tbody>
            <tr>
                <td align="right">
                    <strong>{LANG.name_block}: </strong>
                </td>
                <td>
                    <input style="width: 650px" name="title" type="text" value="{DATAFORM.title}" maxlength="255" />
                </td>
            </tr>
        </tbody>        
        <tbody class="second">
            <tr>
                <td align="right">
                    <strong>{LANG.menu_description}: </strong>
                </td>
                <td>
                    <input style="width: 650px" name="description" type="text" value="{DATAFORM.description}" maxlength="255" />
                </td>
            </tr>
        </tbody>
                    
    </table>
    <br/>
    <center>
        <input name="submit1" type="submit" value="{LANG.save}" />
    </center>
</form>

<!-- END: main -->