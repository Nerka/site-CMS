dojo.provide('sitecms.Layout');

dojo.require('dijit.layout.BorderContainer');
dojo.require("dijit.tree.ForestStoreModel");
dojo.require("dojo.data.ItemFileReadStore");
dojo.require("sitecms.Tree");
dojo.require('dijit._Widget');
dojo.require('dijit._Templated');
dojo.require('dijit.layout.ContentPane');

dojo.declare('sitecms.Layout', dijit.layout.BorderContainer, 
{
    contentWidget:null,
    menuSideBar:null,
    contentContainer: null,
    templateString: dojo.cache("sitecms.Layout", "templates/Layout.html"),
    menuStore: null,
    widgetsInTemplate: true,
     
    postCreate:function()
    {
        dojo.place(this.domNode, dojo.body(), 'first');
        this.createMenuSideBar();
        this.createContentContainer();
    },
    
    createMenuSideBar:function()
    {
        this.menuSideBar = new dijit.layout.ContentPane({splitter:true, region:'leading'});
        dojo.place(this.menuSideBar.domNode, this.domNode, 'first');
    },
    
    createContentContainer:function()
    {
        this.contentContainer = new dijit.layout.ContentPane({region:'center', splitter:true});
        dojo.place(this.contentContainer.domNode, this.menuSideBar.domNode, 'after');
    },
    
    createMenuStore:function()
    {
        this.menuStore = new dojo.data.ItemFileWriteStore({
            url: '/admin/modules'
        });
    }
    
});