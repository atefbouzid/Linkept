// Get the search results data as an array of objects with profile links and content
const searchResults = [
    { 
      link: 'https://example.com/profile/john-smith', 
      title: 'John Smith', 
      content: '<p>Web Developer</p><p>Experience: 5 years</p>' 
    },
    { 
      link: 'https://example.com/profile/jane-doe', 
      title: 'Jane Doe', 
      content: '<p>Graphic Designer</p><p>Experience: 7 years</p>' 
    },
    { 
      link: 'https://example.com/profile/mark-johnson', 
      title: 'Mark Johnson', 
      content: '<p>Project Manager</p><p>Experience: 10 years</p>' 
    },
    { 
      link: 'https://example.com/profile/anna-lee', 
      title: 'Anna Lee', 
      content: '<p>Marketing Specialist</p><p>Experience: 3 years</p>' 
    },
  ];
  
  // Select the profile list element and the selected profile elements
  const profileList = document.querySelector('#profile-list');
  const selectedProfileTitle = document.querySelector('#selected-profile-title');
  const selectedProfileContent = document.querySelector('#selected-profile-content');
  
  // Loop through the search results and add each profile link to the list
  searchResults.forEach(result => {
    const li = document.createElement('li');
    const profileLink = document.createElement('a');
    profileLink.classList.add('profile-link');
    profileLink.textContent = result.title;
    profileLink.href = result.link;
    // Add a click event listener to the profile link that shows the selected profile
    profileLink.addEventListener('click', () => {
      // Update the selected profile title and content
      selectedProfileTitle.textContent = result.title;
      selectedProfileContent.innerHTML = result.content;
    });
    li.appendChild(profileLink);
    profileList.appendChild(li);
  });
  