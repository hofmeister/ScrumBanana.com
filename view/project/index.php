<div id="projects_container">
    <a href="#" class="js-create">Create new project</a>
    <div class="js-formcontainer"></div>
    <div class="js-listcontainer"></div>
</div>
<jst:container id="project_list">
    <table class="data list">
        <thead>
            <tr>
                <th>Name</th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <jst:if test="this.rows.length > 0">
                <jst:each in="this.rows" as="row">
                    <tr class="js{var odd = !odd;odd?'odd':'even';}">
                        <td>
                            js{row.value.name}
                        </td>
                        <td>
                            <a href="#js{row.id}" class="js-edit">Edit</a>
                            |
                            <a href="#js{row.id}" class="js-delete">Remove</a>
                        </td>
                    </tr>
                </jst:each>
                <jst:else>
                    <tr>
                        <td colspan="2">
                            No projects found
                        </td>
                    </tr>
                </jst:else>
            </jst:if>
        </tbody>
    </table>
</jst:container>
<jst:container id="project_form">
    <f:form>
        <input name="_id" type="hidden" value="js{this.data._id}" />
        <f:text name="name" label="Project name" value="js{this.data.name}" />
        <f:buttongroup>
            <f:submit value="Save" />
        </f:buttongroup>
    </f:form>
</jst:container>
<jst:collect />
<script type="text/javascript">
    var Project = {};
    $(function() {
        //Init widgets
        Project = {
            list:new $p.WidgetList($.project_list,"#projects_container .js-listcontainer"),
            form:new $p.Widget($.project_form,"#projects_container .js-formcontainer")
        };
        $.getJSON($p.url('project','listall'),function(data) {
            Project.list.setData(data);
            Project.list.render();
        });
        //Setup handlers
        var c = $('#projects_container');
        //Create handler
        c.find('.js-create').click(function(e) {
            e.preventDefault();
            Project.form.setData({});
            Project.form.render();
        });
        c.find('.js-edit').live('click',function(e) {
            e.preventDefault();
            var id = $(e.target).attr('href').split('#')[1];
            var data = Project.list.getRow("id",id);
            Project.form.setData(data.value);
            Project.form.render();
        });
        c.find('.js-delete').live('click',function(e) {
            e.preventDefault();
            var id = $(e.target).attr('href').split('#')[1];
            Project.list.removeRow("id",id);
            Project.list.render();
        });
    });
</script>