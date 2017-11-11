using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace FirstREST.Lib_Primavera.Model
{
    public class TargetCustomer
    {
        public string id
        {
            get;
            set;
        }

        public string name
        {
            get;
            set;
        }

        public string date
        {
            get;
            set;
        }

        public string location
        {
            get;
            set;
        }

        public string phone_number
        {
            get;
            set;
        }
    }
}
