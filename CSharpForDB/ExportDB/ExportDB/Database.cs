using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ExportDB
{
    class Database
    {
        private MySqlConnection conn;
        private static Database instance;
        private string hostName = "den1.mysql4.gear.host";
        private string databaseName = "valinidatabase";
        private string userName = "valinidatabase";
        private string password = "Valiniipd12!";


        public Database()
        {
            string connectString = string.Format("SERVER ={0};DATABASE={1};UID={2};PWD={3};SslMode=none", hostName, databaseName, userName, password);
            Console.WriteLine(connectString);
            conn = new MySqlConnection(connectString);

            conn.Open();
        }

        public static Database getInstance()
        {
            if (instance == null)
            {
                instance = new Database();
            }

            return instance;
        }


        /*
        public List<Product> GetAllProducts()
        {

            List<Product> productList = new List<Product>();
            using (MySqlCommand command = new MySqlCommand("SELECT * FROM products", conn))
            using (MySqlDataReader reader = command.ExecuteReader())
            {
                while (reader.Read())
                {
                    int id = (int)reader["Id"];
                    string pid = (string)reader["pid"];
                    string name = (string)reader["name"];
                    string brand = (string)reader["brand"];
                    string category = (string)reader["category"];
                    decimal price = (decimal)reader["price"];
                    string description1 = (string)reader["description1"];
                    string description2 = (string)reader["description2"];
                    string imageType = (string)reader["imageType"];
                    Product product = new Product(id, pid, name, brand, category, price, description1, description2, imageType);

                    productList.Add(product);


                }
            }

            return productList;
        }
        */
        public List<Product> GetAllProducts()
        {
            List<Product> productList = new List<Product>();
            string sql = "SELECT p.id PId, s.id supplierId, s.suppName spplierName, s.suppCategory Category, " +
                " p.productName productName, p.description description, p.price price, p.inventoryOnHand inventoryOnHand, " +
                " p.inventoryReceived inventoryReceived, p.inventorysold inventorysold, p.minInventoryLevel minInventoryLevel " +
                " FROM products p JOIN suppliers s ON p.supplierId = s.id; ";
            using (MySqlCommand command = new MySqlCommand(sql, conn))
            using (MySqlDataReader reader = command.ExecuteReader())
            {
                while (reader.Read())
                {
                    int id = (int)reader["PId"];
                    int sid = (int)reader["supplierId"];
                    string sname = (string)reader["spplierName"];
                    string category = (string)reader["Category"];
                    string name = (string)reader["productName"];
                    string description = (string)reader["description"];
                    decimal price = (decimal)reader["price"];
                    int onHand = (int)reader["inventoryOnHand"];
                    int received = (int)reader["inventoryReceived"];
                    int sold = (int)reader["inventorySold"];
                    int minLevel = (int)reader["minInventoryLevel"];

                    Product product = new Product(id, sid, sname, category, name, description, price, received, sold, onHand, minLevel);
                    productList.Add(product);
                }
            }
            return productList;


        }
    }
}
