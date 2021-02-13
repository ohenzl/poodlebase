
import './styles/overview.scss';

// filter logic
//open/close

document.getElementById('filtrButton').addEventListener('click', openClose => {
  let filtr = document.getElementById('filtr');
  if (openClose.target.getAttribute('data-open') === '+') {
    openClose.target.setAttribute('data-open', '-')
    filtr.style.maxHeight = '200px';
  } else {
    openClose.target.setAttribute('data-open', '+')
    filtr.style.maxHeight = '0px';
  }
  console.log(filtr.getAttribute('data-open'))
})


let filterInputs = document.getElementsByClassName('filterInput');

for (let i = 0; i < filterInputs.length; i++) {
  filterInputs[i].addEventListener('keyup', registerKey => {
    filterOutput();
  })
}

function filterOutput() {
  let link = '?';
  for (let i = 0; i < filterInputs.length; i++) {
    if (filterInputs[i].value.length > 2) {
      link += `${filterInputs[i].id}=${filterInputs[i].value}&`
    }
  }
  if (link === '?') return;
  retrieveTableFromSQL(link);
}


//create SQL query based on the function above

 function retrieveTableFromSQL(link) {
   // console.log(link)
   let url = Routing.generate('overviewAPI');
   // console.log(url)

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    }
    xmlhttp.open('GET',url+link,true);
    xmlhttp.send();
}
