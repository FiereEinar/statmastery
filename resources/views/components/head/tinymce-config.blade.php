<script src="https://cdn.tiny.cloud/1/{{ config('app.tinymce_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    disabled: true,
  });

  function setDisabled(val) {
    tinymce.activeEditor.options.set('disabled', val);
  }

  function setTinyMCEContent(content) {
    console.log('Setting Editor content: ', content);
    tinymce.activeEditor.setContent(content);
  }

  function setTinyMCEContentFromEl(e) {
    const encoded = e.getAttribute('data-content');
    const html = atob(encoded); // decode base64
    setTinyMCEContent(html);
  }
  
  function getTinyMCEContent() {
    console.log('Getting Editor content: ', tinymce.activeEditor.getContent());
    return tinymce.activeEditor.getContent();
  }

  function saveContentToLivewire() {
    document.getElementById('editorContent').value = getTinyMCEContent();
    document.getElementById('editorContent').dispatchEvent(new Event('input'));
    Livewire.dispatch('saveContent');
  }
</script>