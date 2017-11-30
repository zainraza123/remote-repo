SELECT RAID
FROM research_agreements
WHERE research_agreement = :research_agreement
        AND companyName = :companyName
        AND organizationID = :organizationID