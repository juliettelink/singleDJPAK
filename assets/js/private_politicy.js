
// pour réaliser une popup sur les conditions de confidentialité
const privacyPolicyLink = document.getElementById('privacy-policy-link');
const privacyPolicyPopup = document.getElementById('privacy-policy-popup');
const closePopup = document.getElementById('close-popup');

privacyPolicyLink.addEventListener('click', function (){
    privacyPolicyPopup.style.display = 'block';
})

closePopup.addEventListener('click', function(){
    privacyPolicyPopup.style.display = 'none';
})