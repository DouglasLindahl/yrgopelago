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
// Define an async function to fetch data from the given URL
async function fetchDataAsync(url) {
  // Fetch the data from the URL
  const response = await fetch(url);
  // Convert the response to JSON format
  let guests = await response.json();
  // Loop through each guest in the guests array
  guests['guests'].forEach((e) => {
    // Loop through each booked day object in the bookedDays object
    for (let x = 0; x < Object.keys(bookedDays).length; x++) {
      // Loop through the range of days between the arrival and departure dates of the current guest
      for (let i = e['arrival_date']; i <= e['departure_date']; i++) {
        // Check if the room of the current guest matches the current booked day object
        if (Object.keys(bookedDays)[x] == e['room']) {
          // If the room matches, add the current day to the bookedDays object for the matching room
          bookedDays[x + 1].push(parseInt(i));
        }
      }
    }
  });

  // Loop through each room
  for (let x = 0; x < rooms.length; x++) {
    // Create a new calendar element
    let calendar = document.createElement('section');
    // Loop through the number of days in the current month
    for (let i = 0; i < months[currenMonth - 1][1]; i++) {
      // Add the 'calendar' class to the calendar element
      calendar.classList.add('calendar');
      // Create a new calendar day element
      let calendarDay = document.createElement('div');
      // Add the 'calendarDay' class to the calendar day element
      calendarDay.classList.add('calendarDay');
      // Loop through the booked days for the current room
      for (let y = 0; y < bookedDays[x + 1].length; y++) {
        // If the current day is in the booked days array, add the 'booked' class to the calendar day element
        if (i + 1 == bookedDays[x + 1][y]) {
          calendarDay.classList.add('booked');
        }
      }
      // Set the 'data-day' attribute of the calendar day element to the current day
      calendarDay.setAttribute('data-day', i + 1);
      // Create a new header element
      let calendarDayHeader = document.createElement('h2');
      // Set the inner HTML of the header element to the current day
      calendarDayHeader.innerHTML = i + 1;
      // Append the header element to the calendar day element
      calendarDay.append(calendarDayHeader);
      // Append the calendar day element to the calendar element
      calendar.append(calendarDay);
    }
    // Append the calendar element to the current room element
    rooms[x].append(calendar);
  }
}
// Invoke the async function and pass in the URL to fetch data from
fetchDataAsync('guests.json');
