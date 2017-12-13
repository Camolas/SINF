using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace FirstREST.Lib_Primavera.Model
{
    public class Activity
    {
        public string id
        {
            get;
            set;
        }

        public string start_date
        {
            get;
            set;
        }
        public string end_date
        {
            get;
            set;
        }

        public string title
        {
            get;
            set;
        }

        public string type
        {
            get;
            set;
        }

        public string client
        {
            get;
            set;
        }

        public string contact_id
        {
            get;
            set;
        }

        public string representative_id
        {
            get;
            set;
        }

        public string location
        {
            get;
            set;
        }

        public string opportunity_id
        {
            get;
            set;
        }

        public string notes
        {
            get;
            set;
        }
    }
}
