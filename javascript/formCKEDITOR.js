

for(i=0;i<5;i++){
  var value= 'editor'+i;
  if(i==0){
    CKEDITOR.replace( 'editor',{
      extraPlugins:'eqneditor,mathjax,pastefromword',
      // extraPlugins:'eqneditor',
    toolbar: [
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
      { name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
      { name: 'colors', items: [ 'TextColor', 'BGColor'] },
      { name: 'links', items: [ 'Link', 'Unlink'] },
      { name: 'anchor', items: [ 'Anchor' ] },
      '/',
      { name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
      { name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
      { name: 'tools', items: [ 'Maximize' ] },
      { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
      { name: 'mathjax', items: [ 'Mathjax' ] },
      { name: 'eqneditor', items: [ 'EqnEditor' ] },
      // { name: 'wiris', items: [ 'MathType' ] },
      // allowedContent: true
      // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    ]
    });
  }else{
  CKEDITOR.replace( value,{
    extraPlugins:'eqneditor,mathjax,pastefromword',
    // extraPlugins:'eqneditor',
  toolbar: [
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
    { name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
    { name: 'colors', items: [ 'TextColor', 'BGColor'] },
    '/',
    { name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
    { name: 'tools', items: [ 'Maximize' ] },
    { name: 'mathjax', items: [ 'Mathjax' ] },
    { name: 'eqneditor', items: [ 'EqnEditor' ] },
    // { name: 'wiris', items: [ 'MathType' ] },
    // allowedContent: true
    // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
  ]
  });
}
}
// CKEDITOR.replace('editor');
// CKEDITOR.replace('editor1');
// CKEDITOR.replace('editor2');
// CKEDITOR.replace('editor3');
// CKEDITOR.add
