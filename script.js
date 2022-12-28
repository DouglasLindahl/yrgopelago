const resetButton = document.querySelector('.resetBooking');

resetButton.addEventListener('click', () => {
  if (confirm('This action cannot be undone!')) {
    window.location.replace('resetBookings.php');
  }
});
