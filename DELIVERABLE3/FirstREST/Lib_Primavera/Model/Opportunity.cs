using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace FirstREST.Lib_Primavera.Model
{
    public class Opportunity
    {
        public string opportunity_id
        {
            get;
            set;
        }

        public string customer_id
        {
            get;
            set;
        }

        public string customer_name
        {
            get;
            set;
        }

        public List<ProposalProduct> products
        {
            get;
            set;
        }

        public string opportunity_type
        {
            get;
            set;
        }

        public string opportunity_state
        {
            get;
            set;
        }

        public string representative_id
        {
            get;
            set;
        }

        public List<Activity> associated_activities
        {
            get;
            set;
        }
    }
}
