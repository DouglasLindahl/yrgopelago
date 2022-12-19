body = document.querySelector('body');
main = body.querySelector('main');
calendar = body.querySelector('.calendar');
const months = [
  ['january', 31],
  ['february', 28],
  ['march', 31],
  ['april', 30],
  ['may', 31],
  ['june', 30],
  ['july', 31],
  ['august', 31],
  ['september', 30],
  ['october', 31],
  ['november', 30],
  ['december', 31],
];
const days = [
  'monday',
  'tuesday',
  'wednesday',
  'thursday',
  'friday',
  'saturday',
  'sunday',
];

let currenMonth = 1;
let currenYear = 2023;
for (let i = 0; i < months[currenMonth - 1][1]; i++) {
  let calendarDay = document.createElement('div');
  calendarDay.classList.add('calendarDay');
  calendarDay.setAttribute('data-day', i + 1);
  let calendarDayHeader = document.createElement('h2');
  calendarDayHeader.innerHTML = i + 1;
  calendarDay.append(calendarDayHeader);
  calendar.append(calendarDay);

  calendarDay.addEventListener('click', (e) => {
    let arrivalDate;
    let departureDate;
    if (arrivalDate == null) {
      arrivalDate = calendarDay.dataset.day;
    } else {
      if (calendarDay.dataset.day < arrivalDate) {
        calendarDay.dataset.day = arrivalDate;
      }
      if (calendarDay.dataset.day >= arrivalDate) {
        calendarDay.dataset.day = departureDate;
      }
    }
    console.log(arrivalDate + ' / ' + departureDate);
  });
}
