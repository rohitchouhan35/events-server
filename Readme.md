Certainly! Here's the content formatted as a README.md file that you can directly use in your GitHub repository:

```markdown
# Events Server

This repository contains the backend server for the Events application. It provides endpoints to add events, retrieve event data, add users, and retrieve user data.

## Getting Started

1. Clone this repository to your local environment.

2. Place the extracted folder named "events-server-main" in the "htdocs" directory of your XAMPP or any web server.

3. Modify the `BASE_URL` in [eventData.js](https://github.com/rohitchouhan35/events-client/blob/main/src/services/eventData.js) if needed. The default value is `const BASE_URL_LOCAL = "http://localhost/events-server-main";`.

```
## Endpoints


### Add Event (POST)

**Request:**
```json
{
    "event_name": "Diwali",
    "start_time": "19/08/1999",
    "end_time": "25/08/2001",
    "location": "Vadodara",
    "description": "Diwali celebration event",
    "category": "Cultural",
    "banner_image": "dummy"
}
```

**Response:**
```json
{
    "status": "201",
    "message": "added successfully"
}
```

### Get Events (POST)

**Request:**
```json
{
    "city": "Vadodara",
    "category": "Dance",
    "date": "04/08/2023"
}
```

**Response:**
```json
{
    "status": 200,
    "message": "Successfully fetched data",
    "data": [
        {
            "id": "30",
            "event_name": "Mega event",
            "start_time": "17/08/2023",
            "end_time": "25/08/2023",
            "location": "Vadodara",
            "description": "new event",
            "category": "Dance",
            "banner_image": "https://www.shutterstock.com/image-vector/music-event-banner-design-template-600w-1551185741.jpg"
        }
    ]
}
```

### Add User (POST)

**Request:**
```json
{
    "name": "Om",
    "email": "om@gmail.com"
}
```

**Response:**
```json
{
    "status": "201",
    "message": "User added successfully"
}
```

### Get All Users (GET)

**Response:**
```json
{
    "status": "200",
    "message": "Successfully fetched user data",
    "data": [
        {
            "id": "1",
            "name": "Om",
            "email": "om@gmail.com"
        }
    ]
}
```

## Database

The database is hosted with a limit of 5MB.

## Notes

- The code assumes a specific project structure and requires included files for proper functioning.
- Adjust URLs and paths as needed to match your server environment.

Please contact on this email in case I've not explained installation clearly or missed something
```

Copy and paste this content into a file named `README.md` in the root directory of your GitHub repository. This markdown format is compatible with GitHub and will render nicely when viewed on the repository page.
