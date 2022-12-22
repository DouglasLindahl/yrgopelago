const body = document.querySelector('body');
const main = body.querySelector('main');
const rooms = document.querySelectorAll('.room');

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
let currenMonth = 1;
let currenYear = 2023;
let bookedDays = {
  1: [],
  2: [],
  3: [],
};
async function fetchDataAsync(url) {
  const response = await fetch(url);
  let guests = await response.json();
  guests['guests'].forEach((e) => {
    for (let x = 0; x < Object.keys(bookedDays).length; x++) {
      for (let i = e['arrival_date']; i < e['departure_date']; i++) {
        if (Object.keys(bookedDays)[x] == e['room']) {
          bookedDays[1].push(parseInt(i));
        }
      }
    }
  });
}
console.log(bookedDays[1]);
fetchDataAsync('guests.json');
for (let x = 0; x < rooms.length; x++) {
  let calendar = document.createElement('section');
  for (let i = 0; i < months[currenMonth - 1][1]; i++) {
    calendar.classList.add('calendar');
    let calendarDay = document.createElement('div');
    calendarDay.classList.add('calendarDay');
    calendarDay.setAttribute('data-day', i + 1);
    let calendarDayHeader = document.createElement('h2');
    calendarDayHeader.innerHTML = i + 1;
    calendarDay.append(calendarDayHeader);
    calendar.append(calendarDay);
  }
  rooms[x].append(calendar);
}
