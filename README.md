# AuditX - External Auditors Management Platform

AuditX is a web application designed to address the needs of the company in managing external auditors. It facilitates the digitalization of audit data and streamlines collaboration between auditors, collaborators, and administrators.

## Problem Statement

The company relies on internal auditors to control banking operations, analyze control procedures, and verify regulatory compliance. However, with the evolving needs of the company, there is a growing demand for auditors to provide added value by offering advice, anticipating risks, and understanding the strategic challenges faced by the company. This necessitates conducting statistical studies on the information collected by auditors and digitizing this data to manipulate it efficiently while avoiding the risks associated with paper-based archives.

## Proposed Solution

To meet the company's requirements, an application called AuditX is proposed. It is a multi-user platform capable of managing auditors and their assignments through three available profiles: Admin, Auditor, and Collaborator.

### Admin Profile

The Admin has the ability to:

- Add new collaborators by providing their name, surname, ID, function, company, and assigned agency.
- Add new agencies for any company within the group.
- Add auditors from external audit firms by providing their name, surname, firm, and contact number.
- Assign auditors to agencies for auditing purposes.
- View and edit all collaborators, agencies, auditors, and audit reports.

### Auditor Profile

The Auditor can:

- Receive notifications for agencies assigned for auditing.
- Create audit forms using a Google Forms-like interface, specifying reference, title, mission, and targeted role.
- Modify created audit forms by adding or removing questions and choosing the desired response type.
- Access agencies they are assigned to and only their collaborators.
- Start auditing each collaborator by inserting their letter of recommendation and answering the proposed questions.
- Deposit audit reports per agency and view the history of audits performed.

### Collaborator Profile

The Collaborator can:

- View a copy of the responses they provided to the auditor during interviews.
  
## Back-End

The back-end is the invisible part of the application for users. It is managed by a MySQL database and the PHP language.

## Visual Design and Ergonomics

The color palette chosen for the web application should match the colors present in the company's logo. User spaces should contain a navigation bar reminding the current user, as well as a dropdown menu containing all the proposed functionalities.
