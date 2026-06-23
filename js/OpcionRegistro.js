function showForm(formId) {
  const forms = document.querySelectorAll('.form-section');
  forms.forEach(form => {
    form.style.display = 'none';
  });
  document.getElementById(formId).style.display = 'block';
}