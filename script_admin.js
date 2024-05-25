// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}
// ---------- CHARTS ----------

// BAR CHART
const barChartOptions = {
  series: [
    {
      data: [50, 40, 30, 20, 10], // Frequencies in percentage
      name: 'Courses',
    },
  ],
  chart: {
    type: 'bar',
    background: 'transparent',
    height: 350,
    toolbar: {
      show: false,
    },
  },
  colors: ['#2962ff', '#d50000', '#2e7d32', '#ff6d00', '#583cb3'],
  plotOptions: {
    bar: {
      distributed: true,
      borderRadius: 4,
      horizontal: false,
      columnWidth: '40%',
    },
  },
  dataLabels: {
    enabled: false,
  },
  fill: {
    opacity: 1,
  },
  grid: {
    borderColor: '#55596e',
    yaxis: {
      lines: {
        show: true,
      },
    },
    xaxis: {
      lines: {
        show: true,
      },
    },
  },
  legend: {
    labels: {
      colors: '#f5f7ff',
    },
    show: true,
    position: 'top',
  },
  stroke: {
    colors: ['transparent'],
    show: true,
    width: 2,
  },
  tooltip: {
    shared: true,
    intersect: false,
    theme: 'dark',
    x: {
      formatter: function (val) {
        return val + "%";
      }
    }
  },
  xaxis: {
    categories: ['MPSC', 'NEET', 'CET', 'UPSC', 'JEE'],
    title: {
      style: {
        color: '#f5f7ff',
      },
    },
    axisBorder: {
      show: true,
      color: '#55596e',
    },
    axisTicks: {
      show: true,
      color: '#55596e',
    },
    labels: {
      style: {
        colors: '#f5f7ff',
      },
    },
  },
  yaxis: {
    title: {
      text: 'Frequency (%)',
      style: {
        color: '#f5f7ff',
      },
    },
    axisBorder: {
      color: '#55596e',
      show: true,
    },
    axisTicks: {
      color: '#55596e',
      show: true,
    },
    labels: {
      style: {
        colors: '#f5f7ff',
      },
    },
  },
};

const barChart = new ApexCharts(
  document.querySelector('#bar-chart'),
  barChartOptions
);
barChart.render();

// AREA CHART
const areaChartOptions = {
  series: [
    {
      name: 'Purchase Orders',
      data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
      name: 'Sales Orders',
      data: [11, 32, 45, 32, 34, 52, 41],
    },
  ],
  chart: {
    type: 'area',
    background: 'transparent',
    height: 350,
    stacked: false,
    toolbar: {
      show: false,
    },
  },
  colors: ['#00ab57', '#d50000'],
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
  dataLabels: {
    enabled: false,
  },
  fill: {
    gradient: {
      opacityFrom: 0.4,
      opacityTo: 0.1,
      shadeIntensity: 1,
      stops: [0, 100],
      type: 'vertical',
    },
    type: 'gradient',
  },
  grid: {
    borderColor: '#55596e',
    yaxis: {
      lines: {
        show: true,
      },
    },
    xaxis: {
      lines: {
        show: true,
      },
    },
  },
  legend: {
    labels: {
      colors: '#f5f7ff',
    },
    show: true,
    position: 'top',
  },
  markers: {
    size: 6,
    strokeColors: '#1b2635',
    strokeWidth: 3,
  },
  stroke: {
    curve: 'smooth',
  },
  xaxis: {
    axisBorder: {
      color: '#55596e',
      show: true,
    },
    axisTicks: {
      color: '#55596e',
      show: true,
    },
    labels: {
      offsetY: 5,
      style: {
        colors: '#f5f7ff',
      },
    },
  },
  yaxis: [
    {
      title: {
        text: 'Purchase Orders',
        style: {
          color: '#f5f7ff',
        },
      },
      labels: {
        style: {
          colors: ['#f5f7ff'],
        },
      },
    },
    {
      opposite: true,
      title: {
        text: 'Sales Orders',
        style: {
          color: '#f5f7ff',
        },
      },
      labels: {
        style: {
          colors: ['#f5f7ff'],
        },
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
    theme: 'dark',
  },
};

const areaChart = new ApexCharts(
  document.querySelector('#area-chart'),
  areaChartOptions
);
areaChart.render();

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

// Function to display fetched records
function fetchRecords() {
  fetch('fetch_records.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      console.log('Records data:', data);
      // Hide default content and show records container
      document.getElementById('default-content').style.display = 'none';
      document.getElementById('charts-container').style.display = 'none';
      document.getElementById('records-container').style.display = 'block';
      // Display the records in the table
      displayRecords(data);
    })
    .catch(error => {
      console.error('Error fetching records:', error);
      // Show error message to user
      alert('Error fetching records. Please try again later.');
    });
}

// Function to display records in a table
function displayRecords(records) {
  const recordsTable = document.getElementById('records-table');
  recordsTable.innerHTML = ''; // Clear previous records
  
  // Check if records exist
  if (records.length > 0) {
    // Create table headers
    const tableHeaders = Object.keys(records[0]);
    const headerRow = document.createElement('tr');
    tableHeaders.forEach(header => {
      const th = document.createElement('th');
      th.textContent = header;
      headerRow.appendChild(th);
    });
    recordsTable.appendChild(headerRow);

    // Loop through the records and create table rows
    records.forEach(record => {
      const row = document.createElement('tr');
      tableHeaders.forEach(header => {
        const td = document.createElement('td');
        td.textContent = record[header];
        row.appendChild(td);
      });
      recordsTable.appendChild(row);
    });
  } else {
    // If no records found, display a message
    const messageRow = document.createElement('tr');
    const messageCell = document.createElement('td');
    messageCell.textContent = 'No records found.';
    messageCell.colSpan = tableHeaders.length;
    messageRow.appendChild(messageCell);
    recordsTable.appendChild(messageRow);
  }
}
// Function to open the add test modal
function openAddTestModal() {
  const addTestModal = document.getElementById('add-test-modal');
  addTestModal.style.display = 'block';
}

// Function to close the add test modal
function closeAddTestModal() {
  const addTestModal = document.getElementById('add-test-modal');
  addTestModal.style.display = 'none';
}

// Function to handle form submission for adding a new test
// Function to handle form submission for adding a new test
// Function to handle form submission for adding a new test
// Function to handle form submission for adding a new test
function submitAddTestForm(event) {
  event.preventDefault(); // Prevent default form submission behavior
  
  const form = document.getElementById('add-test-form');
  // Get form data
  const question = document.getElementById('question').value;
  const option1 = document.getElementById('option1').value;
  const option2 = document.getElementById('option2').value;
  const option3 = document.getElementById('option3').value;
  const option4 = document.getElementById('option4').value;
  const correctAnswer = document.getElementById('correct-answer').value;
  const course = document.getElementById('course').value;

  // Log form data for debugging
  console.log('Form Data:', {
    question: question,
    options: [option1, option2, option3, option4],
    correctAnswer: correctAnswer,
    course: course
  });

  // Prepare the data to be sent to the server
  const formData = {
    question: question,
    options: [option1, option2, option3, option4],
    correctAnswer: correctAnswer,
    course: course
  };

  // Send the form data to the server
  fetch('save_test.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Handle the response from the server
    console.log('Response from server:', data);
    // Display success message
    alert('Test added successfully!');
    // After processing, close the modal
    closeAddTestModal();
  })
  .catch(error => {
    console.error('Error saving test:', error);
    // Show error message to user
    alert('Error saving test. Please try again later.');
  });
}

// SIDEBAR TOGGLE
function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}
// Function to display default content (Dashboard)
function displayDefaultContent() {
  document.getElementById('default-content').style.display = 'grid';
  document.getElementById('charts-container').style.display = 'grid';
  document.getElementById('records-container').style.display = 'none';
}

// Function to display records fetched from the database
function displayRecordsFromDatabase() {
  fetchRecords(); // This function is already defined
}

// Add event listeners to sidebar items
document.getElementById('dashboard-link').addEventListener('click', displayDefaultContent);
document.getElementById('view-records-link').addEventListener('click', displayRecordsFromDatabase);