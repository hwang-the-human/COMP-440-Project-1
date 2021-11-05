const validate = () => {
  const errors = document.querySelector('#errors');
  const password1 = document.querySelector('#password1');
  const password2 = document.querySelector('#password2');

  if (password1.value !== password2.value) {
    errors.innerHTML = '<h4>Passwords do not match!<h4>';
    return false;
  }
  errors.innerHTML = '';
  return true;
};
