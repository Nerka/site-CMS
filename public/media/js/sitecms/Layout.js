dojo.provide('sitecms.Layout');

dojo.require('dijit.layout.BorderContainer');
dojo.require('dijit.tree.ForestStoreModel');

dojo.require('dojo.data.ItemFileWriteStore');
dojo.require('dojo.data.ItemFileReadStore');
dojo.require('sitecms.Tree');
dojo.require('sitecms.UserBlock');

dojo.require('dijit._Widget');
dojo.require('dijit._Templated');
dojo.require('dijit.layout.ContentPane');
dojo.require('dojox.layout.ContentPane');

dojo.declare('sitecms.Layout', dijit.layout.BorderContainer, 
{
    contentWidget: null,
    menuSideBar: null,
    headerBar: null,
    contentContainer: null,
    userData: null,
    menuStore: null,
    treeNode: null,
    treeModel: null,
    menuTree: null,
    userBlock: null,
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
        this.menuSideBar = new dijit.layout.ContentPane({splitter:true, region:'leading', style:'width:200px;'});
        dojo.place(this.menuSideBar.domNode, this.domNode, 'first');
        this.createNodeForTree();
        this.createHeaderBar();
    },
    
    createHeaderBar:function()
    {
        this.headerBar = new dijit.layout.ContentPane({splitter:false, region:'top', style:'height:25px;'});
        dojo.place(this.headerBar.domNode, this.domNode, 'first');
        this.createUserBlock();
    },
    
    createUserBlock:function()
    {
        this.userBlock = new sitecms.UserBlock();
        dojo.place(this.userBlock.domNode, this.headerBar.domNode, 'first');
        this.userBlock.emailUsername.innerHTML = this.userData.email;
    },
    
    createContentContainer:function()
    {
        this.contentContainer = new dojox.layout.ContentPane({region:'center', splitter:true});
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
            store: self.menuStore,
            query: {"type": "module"},
            childrenAttrs: ["children"]
        });  
    },
    
    createNodeForTree:function()
    {
        this.treeNode = dojo.create('div', {}, this.menuSideBar.domNode);
    },
    
    createMenuTree:function()
    {   
        var self = this;
        this.menuTree = new sitecms.Tree({
            model: self.treeModel,
            showRoot: false,
            onClick:function(item)
            {
                self.contentContainer.set('href', item.url);   
            }
        }, this.treeNode);   
    },
    
    getDojoData: function()
    {
        var self = this;
        dojo.xhrPost({
            url: '/admin/models',
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