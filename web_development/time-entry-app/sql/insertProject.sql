INSERT INTO projects
    ( project,
    projectName,
    startDate,
    endDate,
    oldestInvoice,
    totalInvoice,
    projectCap,
    primaryContactName,
    primaryContactEmail,
    APContactName,
    APContactEmail,
    rate,
    type,
    RAID,
    pastDue,
    isActive,
    notes )
VALUES
    ( :project,
        :projectName,
        :startDate,
        :endDate,
        :oldestInvoice,
        :totalInvoice,
        :projectCap,
        :primaryContactName,
        :primaryContactEmail,
        :APcontactName,
        :APcontactEmail,
        :rate,
        :type,
        :RAID,
        :pastDue,
        :isActive,
        :notes )