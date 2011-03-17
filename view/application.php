<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <title><p:sitename /></title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
		<p:stylesheet path="css/reset.css" local="false" />
		<p:stylesheet path="css/oocss.css" local="false" />
		<p:stylesheet path="css/structure.css" local="false"/>
		<p:stylesheet path="css/skin.css" local="false"/>
        <p:stylesheet path="css/site.css" />

        <js:include path="js/extended.js" local="false" />
        <!-- jquery -->
        <js:include path="js/jquery-1.4.4.js" local="false"  minify="false" />
        <js:include path="js/plugins/jquery-json.js" local="false" />
        <js:include path="js/pimple.js" local="false" />
        <js:include path="js/validation.js" local="false" />
        <js:include path="js/template/widget.js" local="false" />

        <js:collect />
        <p:stylesheet collect="true" />

    </head>
    <body>
        <js:setting name="basePath" value="%{Url::basePath()}" />
        <js:setting name="pimplePath" value="%{Settings::get(Pimple::URL)}" />
        <js:setting name="dateFormat" value="%{Settings::get(Date::DATE_FORMAT,'Y-m-d')}" />

        <div>
            <p:loggedin not="true">
                <p:link controller="user" action="login">Login</p:link>
                |
                <p:link controller="user" action="register">Register</p:link>
            </p:loggedin>
            <p:loggedin>
                <user:fullname /> |
                <p:link controller="user" action="logout">Logout</p:link>
                |
                <p:link controller="project" >Projects</p:link>
            </p:loggedin>
        </div>

        <p:body/>
        
        <p:messages />
    </body>
</html>
