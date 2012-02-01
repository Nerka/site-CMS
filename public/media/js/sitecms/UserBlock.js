dojo.provide('sitecms.UserBlock');

dojo.require('dijit._Widget');
dojo.require('dijit._TemplatedMixin');

dojo.declare('sitecms.UserBlock', [dijit._Widget, dijit._TemplatedMixin], 
{
    templateString: dojo.cache("sitecms.UserBlock", "templates/UserBlock.html")
});