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
async function fetchDataAsync(url) {
  const response = await fetch(url);
  let guests = await response.json();
  console.log(guests['guests'][0]['arrival_date']);
}
fetchDataAsync('guests.json');

let currenMonth = 1;
let currenYear = 2023;
let bookedDays = [1, 5, 12, 13];

for (let i = 0; i < months[currenMonth - 1][1]; i++) {
  let calendarDay = document.createElement('div');
  calendarDay.classList.add('calendarDay');
  calendarDay.setAttribute('data-day', i + 1);
  bookedDays.forEach((day) => {
    if (i + 1 == day) {
      calendarDay.classList.add('booked');
    }
  });
  let calendarDayHeader = document.createElement('h2');
  calendarDayHeader.innerHTML = i + 1;
  calendarDay.append(calendarDayHeader);
  calendar.append(calendarDay);
}
