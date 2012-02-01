dojo.provide('sitecms.PageLine');

dojo.require('dijit._Widget');
dojo.require('dijit._TemplatedMixin');

dojo.declare('sitecms.PageLine', [dijit._Widget, dijit._TemplatedMixin], 
{
    templateString: dojo.cache("sitecms.PageLine", "templates/PageLine.html"),
    
    pageData: null,
    contentContainer: null,
    
    postCreate: function()
    {
        this.createLine();
    },
    
    createLine: function()
    {
        this.createdAt.innerHTML = this.pageData.createdat;
        this.pageTitle.innerHTML = this.pageData.name;
        var self = this;
        dojo.connect(this.removePageIcon, 'onclick', function(e){dojo.stopEvent(e); self.removePage()});
        dojo.connect(this, 'onClick', this, 'openPage')
    },
    
    openPage: function()
    {
        this.contentContainer.set('href', '/admin/page?id=' + this.pageData.id);
    },
    
    removePage: function()
    {
        var self = this;
        dojo.xhrPost({
            url:'/admin/removepage?id=' + self.pageData.id,
            load:function()
            {
                self.destroyRecursive();
            }
        });
    }
});