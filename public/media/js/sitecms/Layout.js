dojo.provide('sitecms.Layout');

dojo.require('dijit.layout.BorderContainer');
dojo.require("dijit.tree.ForestStoreModel");
dojo.require("dojo.data.ItemFileWriteStore");
dojo.require("dojo.data.ItemFileReadStore");
dojo.require("sitecms.Tree");
dojo.require("dijit.Tree");
dojo.require('dijit._Widget');
dojo.require('dijit._Templated');
dojo.require('dijit.layout.ContentPane');

dojo.declare('sitecms.Layout', dijit.layout.BorderContainer, 
{
    contentWidget: null,
    menuSideBar: null,
    contentContainer: null,
    templateString: dojo.cache("sitecms.Layout", "templates/Layout.html"),
    menuStore: null,
    treeNode: null,
    treeModel: null,
    menuTree: null,
    widgetsInTemplate: true,
     
    postCreate:function()
    {
        dojo.place(this.domNode, dojo.body(), 'first');
        this.createMenuSideBar();
        this.createContentContainer();
        this.getDojoData();
    },
    
    createMenuSideBar:function()
    {
        this.menuSideBar = new dijit.layout.ContentPane({splitter:true, region:'leading'});
        dojo.place(this.menuSideBar.domNode, this.domNode, 'first');
        this.createNodeForTree();
    },
    
    createContentContainer:function()
    {
        this.contentContainer = new dijit.layout.ContentPane({region:'center', splitter:true});
        dojo.place(this.contentContainer.domNode, this.menuSideBar.domNode, 'after');
    },
    
    createMenuStore:function(dojoData)
    {   
        this.menuStore = new dojo.data.ItemFileWriteStore({
             data: dojoData
        });
    },
    
    createTreeModel:function()
    {
        var self = this
        this.treeModel = new dijit.tree.ForestStoreModel({
            store: self.menuStore
        });  
    },
    
    createNodeForTree:function()
    {
        this.treeNode = dojo.create('div', {}, this.menuSideBar.domNode);
    },
    
    createMenuTree:function()
    {   
        var self = this;
        this.menuTree = new dijit.Tree({
            model: self.treeModel,
            showRoot: false 
        }, this.treeNode);   
    },
    
    getDojoData: function()
    {
        var self = this;
        dojo.xhrPost({
            url:'/admin/models',
            handleAs: 'json',
            load:function(data)
            {
                self.createMenuStore(data);
                self.createTreeModel();
                self.createMenuTree();
            }
        });
    }
    
});