dojo.provide('sitecms.Dialog');

dojo.require('dojox.layout.ContentPane');

dojo.require('dijit._Widget');
dojo.require('dijit._TemplatedMixin');

dojo.declare('sitecms.Dialog', [dijit._Widget, dijit._TemplatedMixin], 
{
    templateString: dojo.cache("sitecms.Dialog", "templates/Dialog.html"),
    widgetsInTemplate:true,
    
    href:'',
    content: '',
    
    postCreate: function()
    {
        dojo.place(this.domNode, dojo.body());
        dojo.connect(this.overlay, 'onclick', this, 'destroyDialog');
        if(this.href)
            this.setContentPaneHref();
    },
    
    setContentPaneHref: function()
    {
        this.contentPane.set('href', this.href);
    },
    
    destroyDialog:function()
    {
        this.destroyRecursive();
    }
});