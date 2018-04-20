using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ExportDB
{
    class Product
    {
        /*
        public int Id { get; set; }
        public string Pid { get; set; }
        public string Name { get; set; }
        public string Brand { get; set; }
        public string Category { get; set; }
        public decimal Price { get; set; }
        public string Description1 { get; set; }
        public string Description2 { get; set; }
        public string ImgType { get; set; }

        public Product(int id, string pid, string name, string brand, string category,
            decimal price, string description1, string description2, string imgType);
            */

        public int Id { get; set; }
        public int SupplierId { get; set; }
        public string SupplierName { get; set; }
        public string Category { get; set; }
        public string Name { get; set; }
        public string Description { get; set; }
        public decimal Price { get; set; }
        public int OnHand { get; set; }
        public int Received { get; set; }
        public int Sold { get; set; }
        public int MinLevel { get; set; }

        public Product(int id, int sid, string sName, string category, string name, string description, decimal price, int received, int sold, int onHand, int minLevel)
        {
            Id = id;
            SupplierId = sid;
            SupplierName = sName;
            Category = category;
            Name = name;
            Description = description;
            Price = price;
            Received = received;
            Sold = sold;
            OnHand = onHand;
            MinLevel = minLevel;
        }
    }

}
