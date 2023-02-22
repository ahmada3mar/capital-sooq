
import axios from "axios";

export default async function (req, res, next) {
    // req is the Node.js http request object

    await  axios.get('http://shpoify.jo/api/test').then(r=>{
        console.log(r.data)
        if(r.data == "no"){
            res.writeHead(301, { Location: "/pages/coming-soon" })
            res.end()            
        }else{
            next()
        }
    })

// console.log(req.url)

//     const conn = mysql.createConnection({
//         'host': 'localhost',
//         'user': 'root',
//         'password': '',
//         'database': 'shopify'
//     });//CREAMOS LA CONECCION


//     if (conn) {
//         conn.query('SELECT * FROM transactions limit 1',
//             (err, rows) => {
//                 if (err) {
//                     console.log(err)
//                 }
//                 else {
//                     console.log("fetch")
//                     var d = rows[0];
//                     if(d.gid == "no" && req.url != "/pages/coming-soon"){
//                         res.writeHead(301, { Location: "/pages/coming-soon" })
//                         res.end()
//                     }else{
//                         next()
//                     }
//                     conn.end()
//                 }
//             }
//         )
//     }
  }