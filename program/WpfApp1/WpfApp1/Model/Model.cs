using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WpfApp1.Model
{
    class Item
    {
        public int ID { get; set; }
        public string Prefix { get; set; }
        public string Ean { get; set; }
        public string Name { get; set; }
        public string Price { get; set; }
        public bool Isscanned { get; set; }

        public Item(int id, string prefix, string ean, string name,string price, bool isscanned)
        {
            this.ID = id;
            this.Prefix = prefix;
            this.Ean = ean;
            this.Name = name;
            this.Price = price;
            this.Isscanned = isscanned;
        }

        public Item()
        {

        }
    }
}
