<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - Study Materials</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">STUDY MATERIALS</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <div style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                <h3 style="color: black;">Upload New Material</h3>
                <form>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: black;">Material Title:</label>
                        <input type="text" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: black;">Course:</label>
                        <select style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                            <option>CSE 101 - Programming Fundamentals</option>
                            <option>MAT 201 - Calculus I</option>
                            <option>ENG 101 - English Composition</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: black;">Upload File:</label>
                        <input type="file" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <button type="submit">Upload Material</button>
                </form>
            </div>
            
            <table style="width: 100%; background-color: white; border-collapse: collapse;">
                <tr style="background-color: rgb(44, 200, 205);">
                    <th style="padding: 10px; border: 1px solid #ddd;">Material ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Title</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Course</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Upload Date</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">M001</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Chapter 1 - Introduction to Programming</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">CSE 101</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">2024-08-20</td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><button style="padding: 5px 10px;">Download</button></td>
                </tr>
            </table>
        </div>
        </center>
    </body>
</html>